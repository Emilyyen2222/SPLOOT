const header = document.querySelector('header');
const body = document.querySelector('body');
const headerLinks = document.querySelectorAll('.headerItem a')

//body class放到header上

header.className = body.className;

//body class放到每個選單的<a>上

headerLinks.forEach(link=>{
    link.className = body.className;
});


