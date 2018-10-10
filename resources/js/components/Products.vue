<template>
    <div>
        <div v-if="!showAddProduct"><button @click="onAddProduct">Add Product</button></div>
        <div v-if="showAddProduct" class="product">
            <input v-model="product" placeholder="Product name"/>
            <button v-if="!showLoader" @click="onAdd">Add</button>
            <button v-if="!showLoader" @click="onCancel">Cancel</button>
            <div v-if="showLoader" class="lds-facebook"><div></div><div></div><div></div></div>
        </div>
        <div class="products">
            <div v-if="showLoader" class="lds-facebook"><div></div><div></div><div></div></div>
            <table border="0">
                <tr v-for="product in products">
                    <td class="product-name">
                        <router-link :to="{ path: 'prices'+'/'+product.id,params:{id:product.id,name:product.name} }">{{product.name}}</router-link>
                    </td>
                    <td><button>Edit</button></td>
                    <td><button @click="onClickProductDelete(product.id)">Delete</button></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
	export default {
		data:function () {
            return{
				showAddProduct:false,
				showLoader:false,
                product:'',
                products:[],
            }
		},
		name: "products",
		props:["baseUrl"],
		created(){
			console.log('aaaaaaaaaaaaaaaa',this.baseUrl);
			this.getProducts()
		},
        methods:{
			onAddProduct(){
				this.showAddProduct=true;
				this.product='';
            },
            onAdd(){
				this.showLoader=true;
				axios.post("http://prices.test/api/products/save",
					{product: this.product})
					.then(response => {
						this.products=response.data;
						this.showLoader = false;
						this.showAddProduct=false;
					})
					.catch(error => {
						this.showLoader = false;
						console.log(error.response)
					});
            },
            onCancel(){
				this.showAddProduct=false;
            },
            getProducts(){
				this.showLoader=true;
				axios.post("http://prices.test/api/products/list",
					{product: this.product})
					.then(response => {
						this.products=response.data;
						console.log(response.data);
						this.showLoader = false;
					})
					.catch(error => {
						console.log(error.response)
						this.showLoader = false;
					});
            },
			onClickProductDelete(id=0){
				console.log(id);
				if (id>0){
					this.showLoader=true;
					axios.post("http://prices.test/api/products/delete/"+id,
						{product: this.product})
						.then(response => {
							this.products=response.data;
							console.log(response.data);
							this.showLoader = false;
						})
						.catch(error => {
							console.log(error.response)
							this.showLoader = false;
						});
                }
            }
        }
	}
</script>

<style scoped>
    button{
        font-size: 1em;
    }
    .product{
        margin-top: 1em;
        position: relative;
    }
    .product input{
        width: 45em;
        font-size: 1em;
    }
    .product button{
        margin-left: .3em;
        width: 8em;
    }
    .products{
        margin-top: 1em;
    }
    .product-name{
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
        animation-delay: 0;
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