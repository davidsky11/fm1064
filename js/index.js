// JavaScript Document
$(function(){
	$("#cdA").click(function(){
		$("#cd li").removeClass();
		$(this).addClass("cdclick");
		$(".section-cont01").css("display","block");
		$(".section-cont02").css("display","none");
		$(".section-cont03").css("display","none");
		$(".section-cont04").css("display","none");
	})
	
	$("#cdB").click(function(){
		$("#cd li").removeClass();
		$(this).addClass("cdclick");
		$(".section-cont01").css("display","none");
		$(".section-cont02").css("display","block");
		$(".section-cont03").css("display","none");
		$(".section-cont04").css("display","none");
	})
	
	$("#cdC").click(function(){
		$("#cd li").removeClass();
		$(this).addClass("cdclick");
		$(".section-cont01").css("display","none");
		$(".section-cont02").css("display","none");
		$(".section-cont03").css("display","block");
		$(".section-cont04").css("display","none");
	})
	
	$("#cdD").click(function(){
		$("#cd li").removeClass();
		$(this).addClass("cdclick");
		$(".section-cont01").css("display","none");
		$(".section-cont02").css("display","none");
		$(".section-cont03").css("display","none");
		$(".section-cont04").css("display","block");
	})

})