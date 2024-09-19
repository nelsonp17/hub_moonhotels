<template>
	<form action="#" class="custom-form">
		<p class="custom-h3">Sign in to your account</p>

		<div>
			<label for="email" class="sr-only">Email</label>

			<div class="relative">
				<input
					type="email"
					class="custom-input"
					placeholder="Enter email"
				/>
			</div>
		</div>

		<div>
			<label for="password" class="sr-only">Password</label>

			<div class="relative">
				<input
					type="password"
					class="custom-input"
					placeholder="Enter password"
				/>

			</div>
		</div>

		<button
			type="submit"
			class="btn-primary btn-block"
		>
			Sign in
		</button>

		<p class="text-center text-sm text-gray-500">
			No account?
			<a class="underline" href="#">Sign up</a>
		</p>
	</form>
</template>
<script setup lang="ts">

</script>
