<template>
  <Transition name="fade" mode="out-in" appear>
    <div
      class="
      mx-auto mt-8 p-8 max-w-2xl rounded-3xl shadow-2xl shadow"
    >
      <div class="row">
        <ul
          v-if="services.length &gt; 0"
          class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3"
        >
          <service-list-service
            v-for="(service, index) in services"
            :key="index"
            :service="service"
          />
        </ul>
      </div>
      <!-- <h2 class="pb-6 text-green-400">Last Step</h2>               @skill-updated="updateSkillInTheUi($event)" -->

      <!-- <Form v-slot="{ meta }" class="text-left">
        <div class="mt-4 mb-8">
          <label class="font-bold" for="email">
            * Email
          </label>

          <Field
            id="email"
            v-model="email"
            class="my-4 pl-4 h-12 w-full bg-gray-600 text-white border-0"
            name="email"
            qa-ref="form-two-email"
            type="email"
            autofocus
          />

           <ErrorMessage
            class="text-red-400"
            name="email"
            qa-ref="form-two-email-error"
          />
        </div>

        <div class="mt-4 mb-8">
          <div class="flex justify-between">
            <label class="font-bold" for="hasAgreeToTerms">
              * I agree with terms and services
            </label>

            <Field
              id="hasAgreeToTerms"
              v-model="hasAgreeToTerms"
              :value="true"
              class="ml-4 h-7 w-7"
              name="hasAgreeToTerms"
              qa-ref="form-two-agree-to-terms"
              type="checkbox"
            />
          </div>

           <ErrorMessage
            as="p"
            class="mt-4 text-red-400"
            name="hasAgreeToTerms"
            qa-ref="form-two-agree-to-terms-error"
          />
        </div>

        <steps-navigation
          :current-step="3"
          :is-next-button-disabled="!meta.valid || !hasAgreeToTerms"
        />
      </Form> -->
    </div>
  </Transition>
</template>

<script lang="ts">
import Vue from 'vue'
import { Services } from '@/types/api'

export default Vue.extend({
  name: 'GetServices',
  data () {
    const services: Services = []
    return {
      services,
    }
  },
  created () {
    this.getServices()
  },
  methods: {
    async getServices (): Promise<void> {
      this.services = (await this.$axios.get('services')).data.data as Services
    },
    // updateSkillInTheUi (event: { initial: any; updated: Skill }) {
    //   const { initial, updated } = event
    //   const index = this.skills.findIndex(skill => skill.name === initial.name)
    //   this.skills[index].name = updated.name
    //   this.skills[index].strength = updated.strength

    //   this.$toast.success('Skill updated')
    // },
  },
})
</script>
