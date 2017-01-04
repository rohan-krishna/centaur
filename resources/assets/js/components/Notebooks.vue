<template>
	<div>
		<div v-show="notebooks.length == 0">
			<p>No notebooks.</p>
		</div>
		<div class="notebooks-container">
			<div class="notebooks-item-wrapper" v-for="notebook in notebooks">
				<div class="notebook-item">
					<a href="#" @click="causeLoadNotes(notebook.id)">
						{{ notebook.title }}
					</a>
				</div>
				<div class="notebook-meta">
					<md-button @click="openDialog('dialog1',notebook.id,notebook.title)">
						<md-icon class="md-accent">create</md-icon>
					</md-button>	
				</div>
			</div>
		</div>
		<!-- 	<ul class="list-group">
				<li class="list-group-item" v-for="notebook in notebooks">
					{{ notebook.title }}
					<br>
					<a href="#" @click="causeLoadNotes(notebook.id)">Load Notes</a>
				</li>
			</ul> -->
		<md-dialog md-open-from="#custom" md-close-to="#custom" ref="dialog1">
		  <md-dialog-title>{{ selectedNotebook }}</md-dialog-title>
		  <form @submit.prevent="submitForm()">
		  <md-dialog-content>
		  	<md-input-container>
		  	   <label>Enter New Title</label>
		  	   <md-input placeholder="Only Text" v-model="title" required="required"></md-input>
		  	 </md-input-container>
		  </md-dialog-content>

		  <md-dialog-actions>
		    <md-button class="md-primary" @click="closeDialog('dialog1')">Cancel</md-button>
		    <md-button class="md-primary" type="submit">Ok</md-button>
		  </md-dialog-actions>
		  </form>
		</md-dialog>
	</div>
	
</template>

<style scoped>
	.notebooks-container {
		display: flex;
		flex-direction: column;
	}
	.notebooks-item-wrapper {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 8px 0;
		margin: 8px 0;
		border-bottom: 1px solid #ddd;
	}
	.notebooks-item-wrapper:first-child {
		margin: 0 0;
	}
	.notebooks-item-wrapper:last-child {
		margin: 0 0;
	}
	.notebook-item > a {
		border-bottom: 1px dotted #ddd !important;
	}
	.notebook-item > a:hover {
		text-decoration: none;
	}
</style>

<script>
	export default {
		props: ['notebooks','bus'],
		data() {
			return {
				title: '',
				selectedNotebook: '',
				notebookID: 0
			}
		},
		mounted() {
			// console.log("Hello People!");
		},
		methods: {
			causeLoadNotes(notebook) {
				// console.log("Event should be dispatched!");
				this.bus.$emit('eventDispatched',notebook);
			},
			submitForm() {
				console.log("Notebook's New Title: " + this.title + " | " + "Notebook ID: " + this.notebookID);
				this.$http.post('notebooks/edit/' + this.notebookID, { title: this.title }).then( (res) => {
					location.reload();
				});
			},
			openDialog(ref,notebookID,selectedNotebook) {
			  this.selectedNotebook = selectedNotebook;
			  this.notebookID = notebookID;
			  // console.log(this.title);
			  this.$refs[ref].open();
			},
		    closeDialog(ref) {
		      console.log(this.title);
		      this.title = '';
		      this.$refs[ref].close();
		    },
		    onOpen() {
		      console.log('Opened');
		    },
		    onClose(type) {
		      console.log('Closed', type);
		    }
		}
	}
</script>