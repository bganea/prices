<template>
    <div class="app">
        <router-view name="header"></router-view>
        <router-view name="nav"></router-view>
        <router-view :base-url="baseUrl" name="content"></router-view>
        <router-view :base-url="baseUrl"></router-view>
    </div>
</template>

<script>
	export default {
		name: "app",
        props:["baseUrl"],
        created(){
			// console.log("app",this.baseUrl);
			// console.log(this.$route);
        }
	}
</script>

<style scoped>
    .app p a{
        font-size: 1.3em;
    }
</style>