$.getScript("https://cdn.jsdelivr.net/gh/sjovanovic/xpull/xpull.js", function(){

   alert("Script loaded but not necessarily executed.");

});

console.log("This that new shit", $('.main').attr('class'));

$('.main').xpull({
    'pullThreshold':50,
    'callback':function(){ alert(111); },
    'spinnerTimeout':2000
 });

console.log("Pull is set");
