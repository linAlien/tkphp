new Vue({
	el:"#app",
	data:{
		phone:"",
		wxNum:"",
		Time:"",
        vip_num:"",
		alertBox:false
	},
	methods:{
		alertBoxFun:function(val){
        	var othis = this;
        	var time;
        	clearTimeout(time);
        	this.alertBox = true;
        	this.alertText = val;
        	time = setTimeout(function(){
        		othis.alertBox = false;
        	},1500)
        },
		getOrder:function(){
        	if(/^1[345678]\d{9}$/.test(this.phone)){
        		if(this.wxNum&&this.Time&&this.vip_num){
        			console.log(this.phone);
        			console.log(this.wxNum);
        			console.log(this.Time);
        			console.log(this.vip_num);

                                //这里写ajax

                    window.location.href = "/index.php?m=Wap&c=Index&a=b_order2";
        		}else{
        			this.alertBoxFun('请填写完整基本信息');
        		}
        	}else{
        		this.alertBoxFun('请输入正确手机格式');
        	}
        }
	}
})