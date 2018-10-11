<template>
    <div class="head">
        <h1>Product prices scanner</h1>
        <router-link class="link" to="/prices/1">Prices</router-link>
    </div>
</template>

<script>
	export default {
		name: "HeaderPr"
	}
</script>

<style scoped>
    .link{
        margin-bottom: 20px;
        display: block;
    }
</style>