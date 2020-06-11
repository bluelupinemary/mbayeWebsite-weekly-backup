<script>
export default {
    name:"Search",
    props:{
        query:String
    },
    data:function() {
            return{
               list:[]
        }
      },
     methods: {
   search() {
      this.renderComponent = false;
      const API = `http://127.0.0.1:8000/api/search/${this.query}`;
      debugger;
      fetch(API)
        .then((response) => {
          if (response.ok) {
            return response.json();
          } else throw response.json();
        })
        .then((responseJson) => {
          this.list = responseJson;
        })
        .catch((err) => alert(err));
    },
  },
  updated () {
      this.$emit('list', this.list)
  }
}       
</script>
 