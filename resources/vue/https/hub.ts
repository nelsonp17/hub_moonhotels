import axios, { AxiosResponse } from "axios";
import {HubFormat, ResponseHub} from "../utils/definitions";

export class hub {
	private url: string;
	private url_search: string;
	constructor() {
		this.url = location.origin + "/api/v1/hub"
		this.url_search = this.url + "/search"
	}
	async search(data: HubFormat) {

		return await new Promise((resolve, reject)=>{
			 axios.post<AxiosResponse<ResponseHub>>(this.url_search, data)
				 .then(async response => {

					 const responseData:AxiosResponse<ResponseHub> = response.data;
					 console.log(responseData);

					resolve(responseData);
				})
				.catch(error => {
					reject(error)
				})
		})
	}
}
