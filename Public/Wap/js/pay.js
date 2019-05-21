new Vue({
	el:"#app",
	data:{
		order_detail:'多群直播付费',
		payPrice:100,
		balance:1.00,
		select_pay:0,
	},
	methods:{
		selectPay(index){
			this.select_pay = index;
		},
		payBtn(){
			var a = this.$refs.sumblit;
			a.submit();
		}
	}
})	