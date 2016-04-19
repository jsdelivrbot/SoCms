$.getScript("https://cdn.rawgit.com/sjovanovic/xpull/master/xpull.js", function(){

   alert("Script loaded but not necessarily executed.");

});

console.log("This that new shit", $('.main'));

$('.day-wrap').xpull({
    'pullThreshold':50,
    'callback':function(){ alert(111); },
    'spinnerTimeout':2000
 });

console.log("Pull is set");
