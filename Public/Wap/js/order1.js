new Vue({
	el:"#app",
	data:{
		classify_index:0,
		classify:[{text:"主题分类"},{text:"主题分类"},{text:"主题分类"},{text:"主题分类"},{text:"主题分类"},{text:"主题分类"},{text:"主题分类"},{text:"主题分类"}],
		phone:'',//手机号码
		wxNum:'',//微信号码
		startTime:'',//开始时间
		Time:'',//直播时长
        type_name:'',//主题
		qunNum:'',//预计群数
		//非必填
		special_helper:'',
		quntext:'',
		alertBox:false,
		alertText:''
	},
	methods:{
		select_classify:function(index){
			this.classify_index = index;
		},
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
        		if(this.wxNum&&this.startTime&&this.Time&&qunNum&&this.type_name){
                    //下单

        			window.location.href = './order2.html'
        		}else{
        			this.alertBoxFun('请填写完整基本信息');
        		}
        	}else{
        		this.alertBoxFun('请输入正确手机格式');
        	}
        }
	},
})