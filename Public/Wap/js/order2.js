new Vue({
	el:"#app",
	data:{
		classify:'主题分类',	 
		startTime:'2018-08-08  18:30',//开始时间
		qunNum:'20',//预计群数
		price:100,
		s_price:100
	},
	methods:{
        getOrder(){
            window.location.href = "/index.php?m=Wap&c=Index&a=pay&id="+id;
        }
	},
})