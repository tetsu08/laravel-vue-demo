<template>
  <PrimevueToast position="bottom-center">
    <template #message="slotProps">
      <div class="custome-content">
        <i
          class="pi pi-check-circle"
          style="font-size: 3rem"
          v-if="slotProps.message.severity == 'success'"
        />
        <i
          class="pi pi-exclamation-triangle"
          style="font-size: 3rem"
          v-else
        />
        <h4>{{ slotProps.message.summary }}</h4>
        <ul class="custome-message">
          <li v-for="item in slotProps.message.detail" :key="item.index">
            {{ item }}
          </li>
        </ul>
      </div>
    </template>
  </PrimevueToast>
</template>

<script lang='ts'>
import { defineComponent } from 'vue';
import PrimevueToast from 'primevue/toast';

export default defineComponent({
  components: {
    PrimevueToast,
  },
});
</script>

<style scoped>
.custome-content {
  text-align: center;
  width: 100%;
}
.custome-message  {
  text-align: left;
}
</style>