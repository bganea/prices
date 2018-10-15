<template>
    <div>
        <div v-if="!showAddProduct"><button @click="onAddProduct">Add Product</button></div>
        <div v-if="showAddProduct" class="product">
            <input type="text" v-model="product" @keyup.enter="onAdd" placeholder="Product name" ref="product"/>
            <input type="hidden" v-model="productId" value="0"/>
            <button v-if="!showLoader" @click="onAdd">
                <span v-if="productId==0">Add</span>
                <span v-if="productId>0">Save</span>
            </button>
            <button v-if="!showLoader" @click="onCancel">Cancel</button>
            <div v-if="showLoader" class="lds-facebook"><div></div><div></div><div></div></div>
        </div>
        <div class="products">
            <div v-if="showListLoader" class="lds-facebook"><div></div><div></div><div></div></div>
            <table border="0">
                <tr v-for="product in products">
                    <td class="product-name">
                        <router-link :to="{ path: 'prices'+'/'+product.id,params:{id:product.id,name:product.name} }">{{product.name}}</router-link>
                    </td>
                    <td><button @click="onEdit(product.id)">Edit</button></td>
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
				showListLoader:false,
                showProducts:true,
                product:'',
                productId:0,
                products:[],
            }
		},
		name: "products",
		props:["baseUrl"],
		created(){
			// console.log('aaaaaaaaaaaaaaaa',this.baseUrl);
			// console.log(this.$route.params);
			this.getProducts()
		},
        methods:{
			onAddProduct(){
				this.showAddProduct=true;
				this.product='';
				this.productId=0;
            },
            onAdd(){
				this.showLoader=true;
				var url="/api/product/save";
				if (this.productId>0){
					url=`/api/product/save/${this.productId}`;
                }
				axios.post(url,
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
            onEdit(id=0){
				if(id>0){
					this.showListLoader=true;
					axios.post(`/api/product/get/${id}`,
						{})
						.then(response => {
							this.showListLoader = false;
							if (response.data.name) {
								this.product = response.data.name;
								this.productId = response.data.id;
								this.showAddProduct = true;
							}
						})
						.catch(error => {
							console.log(error.response);
							this.showListLoader = false;
						});
                }
            },
            onCancel(){
				this.showAddProduct=false;
            },
            getProducts(){
				this.showListLoader=true;
				axios.post("/api/products/list",
					{})
					.then(response => {
						this.products=response.data;
						this.showListLoader = false;
					})
					.catch(error => {
						console.log(error.response)
						this.showListLoader = false;
					});
            },
			onClickProductDelete(id=0){
				if (id>0){
					this.showListLoader=true;
					axios.post("/api/products/delete/"+id,
						{})
						.then(response => {
							this.products=response.data;
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