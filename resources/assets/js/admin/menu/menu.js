$('#nestable').nestable({
	maxDepth: 3,
})
.on('change', updateOutput);

// function parseMenu(ul, menu) {
//     for (var i=0;i<menu.length;i++) {
//         var li=$(ul).append('<li><a href="'+menu[i].slug+'">'+menu[i].name+'</a>');
//         if (menu[i].children!=null) {
//             var subul=$('<ul id="submenu'+menu[i].slug+'">');
//             $(li).append(subul);
//             parseMenu($(subul), menu[i].children);
//             $(li).append('</ul>');
//         }
//         $(ul).append('</li>');
//     }
// }

// var menu=$('#nestable');
// console.log($.parseJSON($('#json-output').text()));
// parseMenu(menu, $.parseJSON($('#json-output').text()));