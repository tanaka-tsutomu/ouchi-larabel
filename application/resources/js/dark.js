import Cookies from 'js-cookie';

// チェックボックスの取得
const btn = document.querySelector("#btn-mode");
// チェックした時の挙動
btn.addEventListener("change", () => {
  if (btn.checked == true) {
    // ダークモード
    document.body.classList.remove("light-theme");
    document.body.classList.add("dark-theme"); 
    
    Cookies.remove("now-mode");
    Cookies.set("now-mode", "dark")
    //alert(Cookies.get("now-mode"));
  } else {
    // ライトモード
    document.body.classList.remove("dark-theme");
    document.body.classList.add("light-theme");
    
    Cookies.remove("now-mode");
    Cookies.set("now-mode", "light")
    //alert(Cookies.get("now-mode"));
  }
});

//cookie読み込み
if (Cookies.get("now-mode") == 'dark') {
  // ダークモード
  document.body.classList.remove("light-theme");
  document.body.classList.add("dark-theme"); 
  document.getElementById("btn-mode").checked = true;
  
  //alert(Cookies.get("now-mode"));
  
} else {
  // ライトモード
  document.body.classList.remove("dark-theme");
  document.body.classList.add("light-theme");
  document.getElementById("btn-mode").checked = false;
  
  //alert(Cookies.get("now-mode"));
}