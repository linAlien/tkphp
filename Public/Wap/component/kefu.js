
Vue.component('kefu',{
	data:function(){
		return {
			img:''
		}
	},
	props:['c_img'],
	template:`
		<div id="mb_kefu">
			<div>
				<h4>联系客服</h4>
				<div class="code">
					<img :src="img" alt="">
				</div>
				<p>长按二维码扫描添加</p>
				<div class="close" @click="close_fun" style="background: url('../Public/Wap/images/close.png')no-repeat center;"></div>
			</div>
		</div>
	`,
	methods:{
		close_fun(){
			Event.$emit('close_kf',false);
		}
	},
	mounted(){
		this.img = this.c_img
	}
})
