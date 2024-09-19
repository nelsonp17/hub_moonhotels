<template>
	<div class="custom-content">

		<!-- Tab -->
		<div class="mx-auto max-w-lg">
			<nav class="center-content gap-6" aria-label="Tabs">
				<a href="#" class="custom-tab-item">
					Settings
				</a>

				<a href="#" class="custom-tab-item active" aria-current="page">
					Notifications
				</a>
			</nav>

		</div>

		<!-- / end Tab -->

		<!-- Form 1 -->
		<div class="py-16">
			<div class="mx-auto max-w-lg">
				<h1 class="custom-title">Get started today</h1>

				<p class="custom-title-small">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati sunt dolores deleniti
					inventore quaerat mollitia?
				</p>

				<FormHub />
			</div>
		</div>
		<!-- / end Form 1 -->
	</div>
</template>

<script setup lang="ts">
	import FormHub from "@/components/forms/FormHub.vue";
</script>
