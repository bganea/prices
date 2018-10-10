<template>
	<div class="prices">
		<div><button v-on:click="sortPrices">Sort Prices</button></div>
		<div style="margin-top: 10px" v-if="!showSorted">
			<table border="0">
				<tr v-for="website in websites">
					<td><a :href="website.url" target="_blank">{{website.shop}}</a></td>
					<td>{{website.price | toCurrency}}</td>
				</tr>
			</table>
		</div>
		<div style="margin-top: 10px" v-if="showSorted">
			<table border="0">
				<tr v-for="website in websites">
					<td><a :href="website.url" target="_blank">{{website.shop}}</a></td>
					<td>{{website.price | toCurrency}}</td>
				</tr>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return{
				pageData:'',
				urlCollection:[
					{
						url:'https://www.emag.ro/masina-de-cusut-computerizata-brother-innov-is-55fe-feshion-edition-152-cusaturi-ecran-lcd-10-modele-butoniera-1-pas-iluminare-led-pedala-de-picior-850-imp-min-alb-nv55fevl1/pd/D29BV7BBM/',
						regex:/EM\.productDiscountedPrice = ([\d]+);/g,
						website:'Emag'
					},
					{
						url:'https://www.pcgarage.ro/ingrijire-tesaturi/brother/innovis-55fe/',
						regex:/"dynx_totalvalue": ([\d]+)/g,
						website:'PC Garage'
					},
					{
						url:'https://www.vexio.ro/masini-de-cusut/brother/181239-masina-de-cusut-casnica-computerizata-nv55fe/?ref=compari&utm_source=compari&utm_medium=pricegrabbers&utm_campaign=Masini+de+cusut&utm_content=Brother&utm_term=Masina+de+cusut+casnica+computerizata+NV55FE',
						regex:/itemprop="price"[\s]+content="([\d]+)/g,
						website:'Vexio'
					},
					{
						url:'https://www.cusutsibrodat.ro/masina-de-cusut-brother-innov-is-55.html',
						regex:/"promo":([\d]+)/g,
						website:'Cusut & Brodat'
					},
					{
						url:'https://decusut.ro/produs/masina-de-cusut-brother-nv55fe-produs-nou/',
						regex:/"value":([\d]+)/g,
						website:'decusut.ro'
					},
					{
						url:'https://www.evomag.ro/electrocasnice-masini-de-cusut-masini-de-cusut/brother-masina-de-cusut-casnica-brother-innov-is-55fe-computerizata-alba-2933502.html',
						regex:/"value":([\d]+)/g,
						website:'Evomag'
					},
					{
						url:'https://www.cumperi-orice.ro/masini-de-cusut/masina-de-cusut-brother-innov-is-55-fashion-edition--135-cusaturi--display-lcd--alb-brother-innov-is-55fe.html',
						regex:/'promo': '([\d]+)/g,
						website:'Cumperiorice'
					},
					{
						url:'https://www.magazinieftin.ro/index.php/catalog/product/view/id/72095/s/masina-de-cusut-brother-innovis-55fe/',
						regex:/'Price': '([\d]+)/g,
						website:'Magazinieftin'
					},
					{
						url:'https://www.kreativshop.ro/index.php/catalog/product/view/id/27440/s/masina-de-cusut-brother-innov-is-55fe/',
						regex:/"promo":([\d]+)/g,
						website:'Kreativshop'
					},
					{
						url:'http://www.domo.ro/masini-de-cusut/masina-de-cusut-brother-innov_is-55fe-135-tipuri-de-cusaturi-iluminare-led-alb-pMiU6Nj0n-l/',
						regex:/value: '([\d]+)/g,
						website:'DOMO'
					}
				],
				showSorted:false,
				websites:[],
				sortedWebsites:[],
			}
		},
		name: "Prices",
		created(){
			// this.getPrices()

		},
		methods:{
			getPrices(){
				for(var i=0;i<this.urlCollection.length;i++){
					this.getPage(i)
				}
			},
			getPage(idx){
				http.get(this.urlCollection[idx].url).then(response=>{
					if (response.body){
						this.pageData=response.body;
						var price=this.getPrice(idx)
						this.websites.push({shop:this.urlCollection[idx].website,price:price,url:this.urlCollection[idx].url})
					}
				}).catch((error) => {
					console.log(error);
				});
			},
			getPrice(idx){
				if (this.pageData) {
					var arr = this.urlCollection[idx].regex.exec(this.pageData)
					if (Array.isArray(arr) && arr.length > 1) {
						return arr[1];
					}
				}
			},
			sortPrices(){
				this.showSorted=true;
				this.websites=this.websites.sort(function (a,b) {
					var key="price"
					var x = Number(a[key]); var y = Number(b[key]);
					return ((x < y) ? -1 : ((x > y) ? 1 : 0));
				});
			}
		}
	}
</script>

<style scoped>
	.prices td{
		color: black;
		font-weight: bold;
	}
	.prices td:nth-child(1){
		padding-right: 20px;
	}
</style>