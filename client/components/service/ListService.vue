<template>
  <div>
    <li
      class="col-span-1 bg-white rounded-lg shadow"
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <div v-if="hover" @click="editModalActive = true">
        <PushButton
          class="mr-2"
          theme="blue"
          size="xs"
          @click="selectService(service.id)"
        >
          +
        </PushButton>
      </div>
      <div class="w-full flex items-center justify-between p-6 space-x-6">
        <div class="flex-1 truncate">
          <div class="flex items-center space-x-3">
            <div class="bg-blue-100 ">
              <img class="object-cover w-auto h-8" :src="service.image_url">
            </div>
          </div>
        </div>
      </div>
    </li>
    <h3
      class="text-gray-900 text-sm text-center leading-5 font-medium truncate"
    >
      {{ service.name }}
    </h3>

    <!-- <modal-base
      v-if="editModalActive"
      :destroyed="() => (editModalActive = false)"
    /> -->
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Service } from '@/client/types/api'

export default Vue.extend({
  name: 'ListSService',
  components: {},
  props: {
    service: {
      type: Object as PropType<Service>,
      required: true,
    },
  },
  data () {
    return {
      hover: false,
      editModalActive: false,
      serviceId: '',
      currentStep: 1,
      step: 1,
    }
  },
  methods: {
    selectService (id: any) {
      this.serviceId = id
      this.currentStep++
    },
  },
})
</script>
