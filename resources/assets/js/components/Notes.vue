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
		<div class="notebooks-addfab">
			<md-button class="md-fab md-primary" @click="addNote()">
			  <md-icon>add</md-icon>
			</md-button>
		</div>
	</div>
</template>
<style>
	.fade-enter-active, .fade-leave-active {
	  transition: opacity .5s
	}
	.fade-enter, .fade-leave-active {
	  opacity: 0
	}

	.list-group-item:first-child {
		border-top-right-radius: 0 !important;
		border-top-left-radius: 0 !important;
		border-top: 1px solid #2196F3;
	}
	.notebooks-addfab {
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 8px;
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
			},
			addNote() {
				var notebooksComponent = $('#notebooksComponent');
				var notesComponent = $('#notesComponent');
				var addNewNoteComponent = $('#addNewNoteComponent');

				CSSPlugin.defaultTransformPerspective = 500;

				TweenLite.to(notebooksComponent, 0.7, { z: '-= 999px' , ease: Power2.easeInOut, autoAlpha: 0, display: 'none' });
				TweenLite.to(notesComponent, 0.7, { z: '-= 999px' , ease: Power2.easeInOut , autoAlpha: 0 , display: 'none' });

				TweenLite.to(addNewNoteComponent, 0.7, { y: '0px' , autoAlpha: 1 , display: 'flex' , ease: Power4.easeInOut, delay: 0.5 });
			}
		}
	}
</script>