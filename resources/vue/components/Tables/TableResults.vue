<template>
	<!-- component -->
	<div class="bg-white p-8 rounded-md w-full">
		<div class="flex items-center justify-between pb-4">
			<div>
				<h2 class="text-gray-600 font-semibold">Lista de reservaciones disponibles</h2>
				<span class="text-xs">{{ listProvider }}</span>
			</div>
			<div class="flex items-center justify-between">
				<div class="flex bg-gray-50 items-center p-2 rounded-md">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
						 fill="currentColor">
						<path fill-rule="evenodd"
							  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
							  clip-rule="evenodd"/>
					</svg>
					<input @input="search" class="bg-gray-50 outline-none ml-1 block" type="search" placeholder="Filtrar...">
				</div>
				<div class="lg:ml-40 ml-10 space-x-8">
					<button class="btn-primary font-semibold tracking-wide" @click="newSearch">
						Nueva búsqueda
					</button>
				</div>
			</div>

		</div>
		<div class="pb-6">

			<h2 class="text-gray-600 font-semibold">Hotel {{ filterSearch.hotelId }}</h2>
			<span class="text-xs">Desde {{ filterSearch.checkIn }} hasta {{ filterSearch.checkOut }}</span>
		</div>

		<div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-center px-2 mx-auto">

				<template v-for="(elem, item) in listView" :key="item">
					<template v-for="(elem2, item2) in elem.rates" :key="item2">
						<article class="bg-white p-6 mb-6 shadow transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
							<a target="_self" href="#" class="absolute opacity-0 top-0 right-0 left-0 bottom-0"></a>
							<div class="relative mb-4 rounded-2xl">
								<img class="max-h-80 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105"
									 src="https://images.pexels.com/photos/163097/twitter-social-media-communication-internet-network-163097.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
								<div
									class="absolute bottom-3 left-3 inline-flex items-center rounded-lg bg-white p-2 shadow-md">
									<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
										 stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-red-700">
										<path stroke-linecap="round" stroke-linejoin="round"
											  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
									</svg>
									<span class="ml-1 text-sm text-slate-400">2</span>

								</div>

								<a class="flex justify-center items-center bg-red-700 bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100"
								   href="/blog/slug" target="_self" rel="noopener noreferrer">
									Reservar habitación
									<svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
										 xmlns="http://www.w3.org/2000/svg">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											  d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
									</svg>
								</a>
							</div>
							<div class="flex justify-between items-center w-full pb-4 mb-auto">
								<div class="flex items-center">
									<div class="pr-3">
										<img class="h-12 w-12 rounded-full object-cover" src="https://images.pexels.com/photos/163097/twitter-social-media-communication-internet-network-163097.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
											 alt="">
									</div>
									<div class="flex flex-1">
										<div class="">
											<p class="text-sm font-semibold ">Habitación {{ elem.roomId }}</p>
											<p class="text-sm text-gray-500">Precio {{ elem2.price }} <small>{{ filterSearch.currency }}</small></p>
										</div>
									</div>
								</div>
								<div class="flex justify-end">
									<div class="text-sm flex items-center text-gray-500 ">
										<span class="relative inline-block px-3 py-1 font-semibold leading-tight" :class="(elem2.isCancellable) ? 'text-green-900' : 'text-red-900'">
											<span class="absolute inset-0 opacity-50 rounded-full" :class="(elem2.isCancellable) ? 'bg-green-200' : 'bg-red-200'"></span>
											<span class="relative">{{ (elem2.isCancellable) ? 'Cancelabe' : 'No cancelabre' }}</span>
										</span>
									</div>
								</div>
							</div>
							<div>
							</div>
						</article>
					</template>
				</template>

			</div>
		</div>

		<button class="button-hero" @click="setListView(list)">Click</button>
	</div>
</template>

<script setup lang="ts">
	import {useSearchStore} from "@/stores/search";
	import {useRouter} from "vue-router";
	import {onMounted, ref} from "vue";
	import {HubFormat, ResponseHub} from "@/utils/definitions";
	const searchStore = useSearchStore();
	const router = useRouter();
	const list = ref(null)
	const listView = ref([])
	const filterSearch = ref<HubFormat>(null)

	const search = (event:Event) =>{
		const text = event.target?.value;
		console.log(text)
	}
	const newSearch = () => {
		router.push({path: '/'})
	}
	defineProps({
		listProvider: String,
	});

	const setListView = (list:ResponseHub)=>{
		listView.value = list.rooms
		console.log(listView)
		// for (const i in list.rooms) {
		// 	console.log(i)
		// 	console.log( list.rooms[i] )
		// }
	}

	onMounted(()=>{
		list.value = searchStore.list;
		filterSearch.value = searchStore.filterSearch;

		setTimeout(()=> setListView(searchStore.list), 3000)
	});
</script>
