<template>
 <p class="button-number">{{this.coolcount}}</p>
</template>

<script>
import EventBus from '../../frontend/event-bus';
export default {
    data:function() {
            return{
                hotcount: '0',
                coolcount: '0',
                naffcount: '0',
        }
      },
     methods: {
    countemotions (emo) {
      this.hotcount = emo.hotcount;
      this.coolcount = emo.coolcount;
      this.naffcount = emo.naffcount;
    }
  },
  mounted () {
    EventBus.$on('GeneralEmotion_sent', (emo) => {
      this.countemotions(emo);
    })
  }
}       
</script>
 