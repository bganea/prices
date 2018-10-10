<template>
	<div>
		<div v-if="!showAddShop"><button @click="onAddProduct">Add Product</button></div>
		<div v-if="showAddShop" class="product">
			<input v-model="product" placeholder="Product name"/>
			<button v-if="!showLoader" @click="onAdd">Add</button>
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
				showAddShop:false,
				showLoader:false,
				showListLoader:false,
				product:'',
				products:[],
			}
		},
		name: "Shops",
	}
</script>

<style scoped>

</style>