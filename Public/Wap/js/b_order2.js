new Vue({
	el:"#app",
	data:{
		Time:'12小时',
		phone:'18312748309',
		wxNum:"aaa123",
		coupon_price:'1200',
		price:4800,
		s_price:3600
	},
	methods:{
        getOrder(){
    window.location.href = "/index.php?m=Wap&c=Index&a=pay&id="+id;
        }
	},
})