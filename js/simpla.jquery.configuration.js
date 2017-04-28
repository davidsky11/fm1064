$(document).ready(function(){
	
	//Menu:
		$('.g_sp_list_menu').each(function(index){
			
		$("#g_sp_list_menu"+index+" li ul").hide(); // Hide all sub menus
		$("#g_sp_list_menu"+index+" li ul").eq(0).slideDown();
		$("#g_sp_list_menu"+index+"li h3.current").parent().find("ul").slideToggle("slow"); // Slide down the current menu item's sub menu
		
		$("#g_sp_list_menu"+index+" li h3.nav-top-item").click( // When a top menu item is clicked...
			function () {
				$(this).parent().siblings().find("ul").slideUp("normal"); // Slide up all sub menus except the one clicked
				$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
				return false;
			}
		);
		
		$("#g_sp_list_menu"+index+" li h3.no-submenu a").click( // When a menu item with no sub menu is clicked...
			function () {
				window.location.href=(this.href); // Just open the link instead of a sub menu
				return false;
			}
		); 
				
	});
	
	
	
	
});
  
  
  