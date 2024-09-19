export interface HubFormat{
	hotelId: number,
	checkIn: string,
	checkOut: string,
	numberOfGuests: number,
	numberOfRooms: number,
	currency: string,
}

export interface ResponseHub{
	rooms: Room[]
}
export interface Room {
	roomId: number;
	rates: Rate[];
}

export interface Rate {
	mealPlanId: number;
	isCancellable: boolean;
	price: number;
}
