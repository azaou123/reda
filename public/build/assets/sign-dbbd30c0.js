const a=document.getElementById("signature-pad"),c=a.querySelector("[data-action=clear]"),r=a.querySelector("[data-action=sign-and-download-contract]"),e=a.querySelector("canvas"),i=document.getElementById("signature-form"),d=document.getElementById("signature"),n=new SignaturePad(e,{backgroundColor:"rgb(255, 255, 255)"});function o(){const t=Math.max(window.devicePixelRatio||1,1);e.width=e.offsetWidth*t,e.height=e.offsetHeight*t,e.getContext("2d").scale(t,t),n.fromData(n.toData())}window.onresize=o;o();c.addEventListener("click",()=>{n.clear()});r.addEventListener("click",async()=>{const t=n.toDataURL();d.value=t,i.submit()});