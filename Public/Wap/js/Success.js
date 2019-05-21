new Vue({
	el:"#app",
	data:{
		code:'7878'
	},
	methods:{
        getOrder(){
        	window.location.href = './pay.html？id=1';
        }
	},
	mounted(){
		console.log(this.code)
	}
})