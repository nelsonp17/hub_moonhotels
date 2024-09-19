// stores/counter.js
import { defineStore } from 'pinia'
import {Room, HubFormat} from "../utils/definitions";

export const useSearchStore = defineStore('search', {
	state: () => {
		return {
			list: {rooms: [] as Room[]},
			textSearch: '',
			listProvider: '',
			filterSearch: '' as unknown as HubFormat,
		}
	},
	actions: {
	},
})
