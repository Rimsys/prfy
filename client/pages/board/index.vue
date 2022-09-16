<template>
  <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-20">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="py-3 px-6">
            Rank
          </th>
          <th scope="col" class="py-3 px-6">
            Reviewer
          </th>
          <th scope="col" class="py-3 px-6">
            Reviewed PRs
          </th>
          <th scope="col" class="py-3 px-6">
            Open PRs
          </th>
          <th scope="col" class="py-3 px-6">
            Overall Score
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="(review, i) in reviews" :key="i" v-if="reviews.length">
          <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            ...
          </th>
          <td scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
            <img class="w-10 h-10 rounded-full" src="http://i.pravatar.cc/150?u=stuart.rodriguez@example.org" alt="avatar">
            <div class="pl-3">
              <div class="text-base font-semibold">{{ review.name }}</div>
            </div>
          </td>
          <td class="py-4 px-6">
            {{ review.reviewed_prs.length }}
          </td>
          <td class="py-4 px-6">
            {{ review.open_prs.length }}
          </td>
          <td class="py-4 px-6">
            {{ review.score }}
          </td>
        </tr>
        <tr v-else>
          <td class="py-4 px-6 text-center">
            ...
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data () {
    return {
      reviews: {},
    }
  },
  async mounted () {
    const response = await this.$axios.get('reviews')
    const { data: { data } } = response
    this.reviews = data
    console.log(data)
  },
}
</script>

<style scoped>

</style>
