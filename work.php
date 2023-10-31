<! DOCTYPE html>    
<html>    
<head>  
  <link href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel = "stylesheet" />  
  <link href = "https://fonts.googleapis.com/css?family=News+Cycle:400,700" rel = "stylesheet">  
</head>  
<style>  
        <meta http-equiv = "Content-Type"    
            content = "text/html; charset=UTF-8" />    
        <title> Example of Language Translation with JavaScript </title>    
        <meta name = "description"/>    
        <meta content = "width=800, initial-scale=1"    
        name = "viewport" />    
<script src =    
"https://code.jquery.com/jquery-3.5.1.min.js">    
        </script>                 
        <script src =    
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"> </script>            
<style>    
h2 {    
  margin-top: 40px;    
  text-transform: none;    
  font-size: 1.75em;    
  font-weight: bold;    
   font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;    
  color: white;     
  letter-spacing: -0.005em;     
  word-spacing: 1px;    
  letter-spacing: none;    
  text-align: center;    
}    
h4 {    
  margin-top: 40px;    
  text-transform: none;    
  font-size: 1.75em;    
  font-weight: bold;    
   font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;    
  color: #999;     
  letter-spacing: -0.005em;     
  word-spacing: 1px;    
  letter-spacing: none;    
  text-align: center;    
  color: white;    
}    
  
@import url("https://fonts.googleapis.com/css?family=Asap&display=swap");  
@import url("https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap");  
@import url("https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap");  
  
* {  
  box-sizing: border-box;  
}  
  
html {  
  height: 100%;  
  overflow: hidden;  
  background-color: #eeeeee;  
  color: #303030;  
  font-family: "Asap", sans-serif;  
}  
body {  
  height: 100%;  
  overflow: hidden;  
  background-color: #eeeeee;  
  color: #303030;  
  font-family: "Asap", sans-serif;  
}  
  
.demo {  
  text-align: center;  
  display: flex;  
  align-items: center;  
  justify-content: center;  
  height: 100%;  
}  
  
.lang {  
  margin: 0 auto;  
}  
  
.button_lang {  
  cursor: pointer;  
  display: inline-block;  
  padding: 0.25em 0em;  
  border-radius: 10px;  
  width: 5em;  
  transition: 0.25s ease;  
}  
  
.button_lang:hover {  
  background: #b5d6b2;  
  transition: 0.25s ease;  
}  
  
.current_lang {  
  background: #b5d6b2;  
}  
  
.translation {  
  text-align: center;  
  margin: 0.5em;  
}  
  
.english {  
  font-family: "Asap", sans-serif;  
}  
  
.chinese {  
  font-family: "Noto Sans SC", sans-serif;  
  font-size: 1.5em;  
}  
  
.japanese {  
  font-family: "Noto Sans JP", sans-serif;  
  font-size: 2em;  
}  
</style>  
<body>  
<h2> Example </h2>  
<h4> Language Translation with JavaScript </h4>  
<div class="demo">  
  <div>  
    <table class="lang">  
      <tr>  
        <td class="tdlang">  
          <span id="en" class="button_lang current_lang">EN</span>  
        </td>  
        <td class="tdlang"> <span id="cn" class= "button_lang"> ?? </span> </td>  
        <td class="tdlang"> <span id="jp" class= "button_lang"> ???  </span> </td>  
      </tr>  
    </table>  
    <div class="translation english" id="translate">  
   Hello,   
 The text here will change  
    </div>  
  </div>  
</div>var english = document.getElementById("en"),  
  japanese = document.getElementById("jp"),  
  chinese = document.getElementById("cn"),  
  change_text = document.getElementById("translate");  
english.addEventListener("click", function() {  
    change(english, japanese, chinese);  
  }, false  
);  
japanese.addEventListener("click", function() {  
    change(japanese, english, chinese);  
  }, false  
);  
  
chinese.addEventListener("click", function() {  
    change(chinese, english, japanese);  
  }, false  
);  
  
function change(lang_on, lang_off1, lang_off2) {  
  if (!lang_on.classList.contains("current_lang")) {  
      
    lang_on.classList.add("current_lang");  
    lang_off1.classList.remove("current_lang");  
    lang_off2.classList.remove("current_lang");  
  }  
  
  if (lang_on.innerHTML == "EN") {  
    change_text.classList.add("english");  
    change_text.classList.remove("chinese");  
    change_text.classList.remove("japanese");  
    change_text.innerHTML = "The text here will change";  
  }    
  else if (lang_on.innerHTML == "??") {  
    change_text.classList.add("chinese");  
    change_text.classList.remove("english");  
    change_text.classList.remove("japanese");  
    change_text.innerHTML = "????????";  
  }  
    
  else if (lang_on.innerHTML == "???") {  
    change_text.classList.add("japanese");  
    change_text.classList.remove("english");  
    change_text.classList.remove("chinese");  
    change_text.innerHTML = "???????????";  
  }  
}  
</script>  
</body>  
</html>  