<template>
	<div>
		<div class="notebooks-container">
			<div v-show="loading">Loading ...</div>
			<div class="notebooks-item-wrapper" v-for="notebook in notebooks" v-show="!loading">
				<div class="notebook-item">
					<a href="#" @click="causeLoadNotes(notebook.id)">
						<h4>{{ notebook.title }}</h4>
					</a>
				</div>
				<!-- <div class="notebook-meta">
					<md-button @click="openDialog('dialog1',notebook.id,notebook.title)" class="md-primary md-raised">
						<md-icon>create</md-icon>
					</md-button>
					<md-button @click="openDialog('dialog1',notebook.id,notebook.title)" class="md-primary md-raised">
						<md-icon>create</md-icon>
					</md-button>	
				</div> -->
			</div>
		</div>
		<div class="notebooks-addfab">
			<md-button class="md-fab md-primary" @click="openDialog('addNotebookModal')">
			  <md-icon>add</md-icon>
			</md-button>
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

		<md-dialog ref="addNotebookModal">
			<md-dialog-title>Add New Notebook</md-dialog-title>
			<form @submit.prevent="addNotebook()">
			<md-dialog-content>
					<md-input-container>
						<label>Title : </label>
						<md-input placeholder="Enter Title for New Notebook" v-model="title" required="required"></md-input>
					</md-input-container>
			</md-dialog-content>

			<md-dialog-actions>
				<md-button class="md-accent md-raised" type="submit">Add Notebook</md-button>
				<md-button class="md-primary md-raised" @click="closeDialog('addNotebookModal')">Close</md-button>
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
		padding: 8px 16px;
		margin: 8px 0;
		border-bottom: 1px solid #ddd;
	}
	.notebooks-item-wrapper:first-child {
		margin: 0 0;
		/*border-top: 1px solid #fff;*/
	}
	.notebooks-item-wrapper:last-child {
		margin: 0 0;
		/*border-bottom: 0;*/
	}
	.notebook-item > a {
		/*border-bottom: 1px dotted #ddd !important;*/
		text-align: center;
	}
	.notebook-item > a:hover {
		text-decoration: none;
	}
	.notebook-item {
		display: flex;
		flex-direction: column;
		align-content: stretch;
		flex-grow: 1;
	}
	.notebook-meta {
		display: flex;
		flex-grow: 0;
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
				title: '',
				selectedNotebook: '',
				notebookID: 0,
				notebooks: [],
				loading: true
			}
		},
		mounted() {
			this.$http.get("api/notebooks").then( (res) => {
				this.notebooks = res.data;
				this.loading = false;
			});
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
			addNotebook() {
				// console.log("Triggered!");
				this.notebooks.push({ title: this.title });

				this.$http.post('notebooks', { title: this.title }).then( (res) => {
					// console.log("Persisted!");
					// console.log(this.title);
					this.notebooks = res.body;
				});
				
				this.closeDialog('addNotebookModal');
			},
			openDialog(ref) {
			  // this.selectedNotebook = selectedNotebook;
			  // this.notebookID = notebookID;
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