<template>
    <div class="app">
        <h1>Product prices scanner</h1>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
	export default {
		name: "app"
	}
</script>

<style scoped>
    .app p a{
        font-size: 1.3em;
    }
</style>