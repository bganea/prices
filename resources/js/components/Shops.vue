<template>
	<div>
		<div v-if="!showAddShop"><button @click="onAddShop">Add Shop</button></div>
		<div v-if="showAddShop" class="shop">
			<div><input v-model="shop" placeholder="Shop name"/></div>
			<div><input v-model="url" placeholder="Shop URL"/></div>
			<div><input v-model="regex" placeholder="Shop regex"/></div>
			<div v-if="!showLoader">
				<button @click="onAdd">Add</button>
				<button @click="onCancel">Cancel</button>
			</div>
			<div v-if="showLoader" class="lds-facebook"><div></div><div></div><div></div></div>
		</div>
		<div class="shops">
			<div v-if="showListLoader" class="lds-facebook"><div></div><div></div><div></div></div>
			<table border="0">
				<tr v-for="shop in shops">
					<td class="shop-name">
						<router-link :to="{ path: 'shops'+'/'+shop.id,params:{id:shop.id,name:shop.name} }">{{shop.name}}</router-link>
					</td>
					<td><button>Edit</button></td>
					<td><button @click="onClickShopDelete(shop.id)">Delete</button></td>
				</tr>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		data:function () {
			return{
				showAddShop:false,
				showLoader:false,
				showListLoader:false,
				shop:'',
				url:'',
				regex:'',
				shops:[],
			}
		},
		name: "Shops",
		created(){
			this.getShops()
		},
		methods:{
			onAddShop(){
				this.showAddShop=true;
				this.shop='';
				this.url='';
				this.regex='';
			},
			onAdd(){
				this.showLoader=true;
				axios.post("/api/shops/save",
					{name: this.shop,url:this.url,regex:this.regex})
					.then(response => {
						this.shops=response.data;
						this.showLoader = false;
						this.showAddShop=false;
					})
					.catch(error => {
						this.showLoader = false;
						console.log(error.response)
					});
			},
			onCancel(){
				this.showAddShop=false;
			},
			getShops(){
				this.showListLoader=true;
				axios.post("/api/shops/list",
					{})
					.then(response => {
						console.log(response.data);
						this.shops=response.data;
						this.showListLoader = false;
					})
					.catch(error => {
						console.log(error.response)
						this.showListLoader = false;
					});
			},
			onClickShopDelete(id=0){
				if (id>0){
					this.showListLoader=true;
					axios.post("/api/shops/delete/"+id,
						{})
						.then(response => {
							this.shops=response.data;
							this.showListLoader = false;
						})
						.catch(error => {
							console.log(error.response)
							this.showListLoader = false;
						});
				}
			}
		}
	}
</script>

<style scoped>
	.shop{
		margin-top: 1em;
		position: relative;
	}
	.shop div input{
		width: 45em;
		font-size: 1em;
	}
	.shop div:nth-child(2),.shop div:nth-child(3),.shop div:nth-child(4){
		margin-top: .5em;
	}
	.shops{
		margin-top: 1em;
	}
	.shop-name{
		width: 10em;
	}
	.lds-facebook {
		display: inline-block;
		position: relative;
		width: 64px;
		/*height: 39px;*/
		top:-39px;
	}
	.lds-facebook div {
		display: inline-block;
		position: absolute;
		left: 6px;
		width: 13px;
		background: #000;
		animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
	}
	.lds-facebook div:nth-child(1) {
		left: 6px;
		animation-delay: -0.24s;
	}
	.lds-facebook div:nth-child(2) {
		left: 26px;
		animation-delay: -0.12s;
	}
	.lds-facebook div:nth-child(3) {
		left: 45px;
		animation-delay: 0s;
	}
	@keyframes lds-facebook {
		0% {
			top: 6px;
			height: 51px;
		}
		50%, 100% {
			top: 19px;
			height: 26px;
		}
	}
</style>