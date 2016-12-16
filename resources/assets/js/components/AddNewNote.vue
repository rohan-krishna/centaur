<template>
	<div style="display: flex; flex: 1;">
		<div class="centaur--hero-card">
			<div class="centaur--hero-card---header">
				<input type="text" class="newnote-title" placeholder="Title" autofocus="autofocus">
			</div>
		</div>
	</div>
</template>

<style scoped>
	.centaur--hero-card {
		display: flex;
		flex-direction: column;
		flex: 1;
	}

	.centaur--hero-card---header {
		padding: 0.52em 0;
		border-top-left-radius: 4px;
		border-top-right-radius: 4px;

		border-bottom: 1px dashed #2196F3;
	}

	.newnote-title {
		width: 100%;
		background: transparent;
		border: 0;
		font-size: 22px;
		font-family: 'Raleway', sans-serif;
		outline: none;
	}
</style>
<script>
	export default {
		mounted() {
			console.log("addNewNote Component loaded!");
		}
	}
</script>