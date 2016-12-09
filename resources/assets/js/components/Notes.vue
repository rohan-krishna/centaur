<template>
	<div>
		<p v-if="loading">Loading ...</p>
		<transition name="fade">
			<ul class="list-group" v-if="notes.length != 0 && loading == false">
				<li v-for="note in notes" class="list-group-item">
					<p>{{ note.title }}</p>
					<p>{{ note.body }}</p>
				</li>
			</ul>
		</transition>
		<p v-if="notes.length == 0 && loading == false">No Notes!</p>
	</div>
</template>
<style>
	.fade-enter-active, .fade-leave-active {
	  transition: opacity .5s
	}
	.fade-enter, .fade-leave-active {
	  opacity: 0
	}
</style>
<script>
	export default {
		props: ['bus'],
		data() {
			return {
				loading: true,
				message: 'Hello World!',
				notes: []
			};
		},
		mounted() {
			this.$http.get('api/allNotes').then((res) => {
				this.notes = res.data;
				this.loading = false;
			});
		},
		created() {
			this.bus.$on('eventDispatched', function(notebook) {
				return this.loadNotes(notebook);
			}.bind(this));
		},
		methods: {
			loadNotes(notebook) {
				this.loading = true;
				// console.log("PING! Found something!" + notebook);
				this.$http.get('api/notes', {params: { notebook : notebook }} ).then( (res) => {
					this.notes = res.data;
					this.loading = false;
				});
				// this.notes = [{'title' : 'Notebook ID intercepted from emitted event: ' + notebook}];
			}
		}
	}
</script>