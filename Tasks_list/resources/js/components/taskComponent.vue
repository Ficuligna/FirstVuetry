<template>
    <div v-show = "!destroied && !archived && get_select() && filter_by_title()" class="container">

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">

                      <span @click="filter_by_title()"v-if="id">this is the task n° {{id}}</span>
                      <span v-else>this is a new task {{new_id}}</span>
                      <span v-if="creator">created by: {{creator}}</span>
                      <span v-else>created by: {{user}}</span>
                      <span class="owner" v-if="owner(user)">Owner</span>

                      <div v-if="!is_stored('no')" class="actionbutt">
                        <span v-show="!isEditField(name)" class="actionbutt" @click = "destroy">Delete</span>
                        <span v-show="isEditField(name)" class="actionbutt" @click = "cancel"> Cancel </span>
                        <span v-show="isEditField(name)" class="actionbutt" @click = "update"> Update </span>
                      </div>
                      <div v-else class="actionbutt">
                        <span class="actionbutt" @click = "store">Create task</span>
                      </div>


                    </div>
                    <div class="card-body">
                        <span>title: </span> <span v-show="!isEditField(name)" @click="edit_field(name)">
                          {{dataName}}
                        </span>
                        <input v-show="isEditField(name)" type="text" v-model="dataName">

                        <div v-if="!yarchived" class="completed">
                          Completed: <input type="checkbox" name="completed" value="" @click="checked_function"><br>
                          <button v-show="checked" type="button" name="button" @click ="archive">archive</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data: function(){

        return {
          archived: false,
          checked: false,
          destroied: false,
          editField: " ",
          dataName: this.name,
          storeTask: this.stored
        }
      },

      props: {
        selectvalue: String,
        new_id: Number,
        user: String,
        creator: String,
        id: Number,
        name: String,
        stored: String,
        yarchived: String,
        archivedbyuser: String,
        filterbyname: String
      },

      methods:{
        filter_by_title(){
          if (
            this.filterbyname == ""
            || this.filterbyname == undefined
            || this.dataName.includes(this.filterbyname)
            || this.dataName.includes(this.filterbyname)
            || this.creator.includes(this.filterbyname)
             )
             {
            console.log("vero");
            return true;
          }else {
            console.log("falso");
            return false;
          }
        },
        get_select(){
          if (this.selectvalue == " ") {
            return true;
          }else {

            return this.selectvalue == this.archivedbyuser;
          }
        },

        check_creator(){

        },


        owner(field){
          return this.creator === field;
        },


        is_stored(answer){
          return this.storeTask == answer;
        },


        store(){
          var _this = this;
          var task ={
            _token: token,
            name: this.dataName
          }
          axios.post("/store", task)
          .then(function(response){
            // console.log(response);
            _this.storeTask = "yes"
          })
          .catch(function(err){
          alert("You are Unauthorized");
          });
        },


        checked_function(){
          if (!this.checked) {
            this.checked = true;
          }else {
            this.checked = false;
          }
        },


        edit_field(field){
          this.editField = field;
        },


        isEditField(field){
          return this.editField == field;
        },


        update(){
        var _this = this;
        if (this.id) {
          var id = _this.id
        }else {
          var id = _this.new_id;
        }
         var task ={
           _token: token,
           name: this.dataName
         }
          axios.post("/update/" + id, task)
          .then(function(response){
            // console.log(response);
            _this.edit_field("");
          })
          .catch(function(err){
            alert("You are Unauthorized");
          });
        },


        cancel(){
          this.editField = "";
          this.dataName = this.name;
        },


        destroy(){
          var _this = this;
          if (this.id) {
            var id = _this.id
          }else {
            var id = _this.new_id;
          }
          axios.post("/destroy/" + id)
          .then(function(response){
            if (response["status"] == 200) {
              _this.destroied = true;
            }
            // console.log(response);
          })
          .catch(function(err){
            if (err) {
              alert("You are Unauthorized");
            }
            // console.log(err);
          });
        },


        archive(){
          var task ={
            _token: token,
          }
          var _this = this;
          if (this.id) {
            var _thisid = this.id;
          }else {
            var _thisid = this.new_id;
          }
          axios.post("/archive/" + _thisid,task)
          .then(function(response){
            if (response["status"] == 200) {
              _this.archived = true;
            }
          })
          .catch(function(err){
            if (err) {
              alert("You are Unauthorized");
            }
            console.log(err);
            alert("You are Unauthorized");
          });
        }
      },


        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
