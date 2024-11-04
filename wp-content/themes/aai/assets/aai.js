// basics
const bodyClasses = document.body.classList; // usage: bodyClasses.contains('my-class-name')
const LANG = document.documentElement.lang === 'en-GB' ? 'en/' : '';
const ENV = window.location.host;
let devENV = null;
let basepath = '/';
if (ENV == 'localhost' || ENV == 'meuro.dev') {
  basepath = '/AAI/';
  devENV = true;
}
const themepath = basepath+'wp-content/themes/aai/';
let LoadHPCont;


// aai.js
const position = { x: 0, y: 0 }
var angle = 0
var scale = 1.0


function onMove(event) {    
  position.x += event.dx;
  position.y += event.dy;

  angle += event.da ? event.da : 0;
  scale += event.ds ? event.ds : 0;

  event.target.style.transform =
    `translate(${position.x}px, ${position.y}px)
     rotate(${angle}deg)
     scale(${scale})`;
}


interact('.ammenniccolo')
  .draggable({
    inertia: {
      resistance : 5,
      endSpeed : 5,
      allowResume : true,
      smoothEndDuration : 200
    },
    modifiers: [
      interact.modifiers.restrict({
        restriction: 'parent',
        endOnly: true,
      })
    ],
    listeners: {     
      move : onMove
    }
  })
  .on('tap', function (event) {
    window.location.href = event.currentTarget.dataset.href;
    console.debug({event});
    event.preventDefault();
  })
 

// appends nav links at the bottom of the window
const scrollUP = document.getElementById("scroll-up");
const goHome = document.getElementById("home-link");
scrollUP.addEventListener('click', () => { window.scrollTo({top: 0, behavior: 'smooth'}); })
goHome.addEventListener('click', () => { location.href=basepath; })


// foglia: load the posts in homepage as the user approaches the end of page
if (bodyClasses.contains('post-template-default') === true) {

  bodyClasses.add('moreposts');
  let postareaTarget = document.getElementById('wrap');
  const currentpostID = postareaTarget.querySelector('article').id;
  let postareaDiv,
    fillnonce = null;

  LoadHPCont = () => {
    fetch(basepath+LANG) // fetch homepage URL
    .then(function(response) {
        return response.text();
    })
    .then(function(html) {
      // get the article list
      let parser = new DOMParser();
      let doc = parser.parseFromString(html, "text/html");

      
      let HPDOM = doc.querySelector('#primary');
      let articles = Array.from(HPDOM.querySelectorAll('article'));
      let articleIds = articles.map(article => article.id);
      
      // Remove current article if found: we don't want to suggest the same article we are reading 
      if (articleIds.includes(currentpostID)) {
        let currentArticle = articles.find(article => article.id === currentpostID);
        currentArticle.remove();
      }
      
      HPDOM = HPDOM.innerHTML;
      
      console.debug(HPDOM);
      console.debug(currentpostID);

      // create container div
      postareaDiv = document.createElement('div');
      postareaDiv.id = 'post-area';
      postareaDiv.classList.add('append-posts');
      postareaTarget.append(postareaDiv);


      // listen scroll pos and fill the div
      const scrolltrigger = document.documentElement.scrollHeight / 2; // half page
      document.addEventListener('scroll', function() {
        if (!fillnonce) {
          setTimeout(function() { 
            if (document.documentElement.scrollTop >= scrolltrigger && !fillnonce){
              console.debug('metà pagina: '+scrolltrigger);

              // fill the div
              postareaDiv.innerHTML = HPDOM;

              let appendImgs = postareaDiv.getElementsByTagName('img');
              Array.from(appendImgs).forEach((el) => {
                  el.addEventListener('contextmenu', event => event.preventDefault());
                  el.addEventListener('dragstart', function(event) { event.preventDefault(); });
              })

              fillnonce = true;
            }
          },500);
        }
      })
    })
    .catch(function(err) {  
      console.debug('Failed to fetch page: ', err);
    });

  }

  LoadHPCont();
}


