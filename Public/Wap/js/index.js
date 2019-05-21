
new Vue({
	el:'#app',
	data:{
		nav:0,
		arr:[
			{
				hd_img:'../public//images/hd_img.jpg',
				// 收费列表，
				collect_fees:[
					{
						num:'0-50个群',
						price:'0'
					},
					{
						num:'51-100个群',
						price:'0'
					},
					{
						num:'101个群以上',
						price:'0'
					}
				],
				explain_title:'直播说明',
				explain:'直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播直播说明可以很多文字直播说明可以很多文字直播说以很多文字直播 说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文说明可以很多文字直播直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播 说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播'
			},
			{
				hd_img:'../public/images/hd_img.jpg',
				collect_text:'收费规则',
				// 收费列表，
				collect_fees:[
					{
						num:'0-50个群',
						price:'0'
					},
					{
						num:'51-100个群',
						price:'0'
					},
					{
						num:'101个群以上',
						price:'0'
					}
				],
				explain_title:'录播说明',
				explain:'录播说明说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播说明可以很多文说明可以很多文字直播直播说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播 说明可以很多文字直播说明可以很多文字直播说明可以很多文字直播'
			},
			{
				hd_img:'../public/images/hd_img.jpg',
				monthly:'100',
				privilege:[
					{text:'好厉害好厉害反正好厉害',url:"#"},
					{text:'好厉害好厉害反正好厉害',url:"#"},
					{text:'好厉害好厉害反正好厉害',url:"#"},
					{text:'好厉害好厉害反正好厉害',url:"#"},
				]
			},
		],
		kefu_img:'../public/images/hd_img.jpg',
		//客服二维码
		code_img:img1,
		//客服蒙版
		kefu_box:false
	},
	methods:{
		changeNav(index){
			this.nav = index;
		},
		getOrder(){
			switch(this.nav){
				case 0:
					window.location.href = "/index.php?m=Wap&c=Index&a=order1&type=1";
				break;
				case 1:
                    window.location.href = "/index.php?m=Wap&c=Index&a=order1&type=2";
				break;
				case 2:
                    window.location.href = "/index.php?m=Wap&c=Index&a=b_order1";
				break;
			}
		}
	},
	mounted(){
		let othis= this;
    console.log(index_id);
        this.changeNav(index_id-1);
		Event.$on('close_kf',function(){
			othis.kefu_box = false;
		})
	}
})