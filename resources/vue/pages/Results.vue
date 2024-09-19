<template>
	<div class="bg-gray-50">
		<div class="custom-content">
			<div class="custom-container">
				<TableResults :list-provider="listProvider" />

			</div>
			<button class="button-hero" @click="button" >Click button </button>
		</div>
	</div>
</template>

<script setup lang="ts">
	import {useSearchStore} from "@/stores/search";
	import TableResults from "@/components/Tables/TableResults.vue";
	import {onMounted, ref} from "vue";
	import {useRouter} from "vue-router";
	const searchStore = useSearchStore();
	const router = useRouter();
	const listProvider = ref("")
	const button = () => {
		console.log(searchStore.list)
	}
	onMounted(()=>{
		if(searchStore.listProvider == 'all'){
			listProvider.value = "Todas las reservaciónes"
		}
		if(searchStore.listProvider == ''){
			router.push({path: '/'})
		}
	});
</script>
