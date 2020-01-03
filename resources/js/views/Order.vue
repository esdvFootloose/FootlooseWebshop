<template>
  <div class="content order-edit">
    <div class="heading">
      <h1>Order {{order.id}}</h1>
    </div>
    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Type</th>
          <th>Size</th>
          <th>Amount</th>
          <th>In stock</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in order.ordered_item" :key="item.id" class="row">
          <td class="align--top">{{item.stock.item.name}}</td>
          <td class="align--top">{{item.stock.item.gender}}</td>
          <td class="align--top">
            <select v-model="item.stock.size">
              <option
                v-for="size in getStock(item.stock.item.slug).stock"
                :key="size.id"
                :value="size.size"
              >{{ size.size }}</option>
            </select>
          </td>
          <td class="align--top">{{item.amount}}x</td>
          <td>
            <table>
              <tr v-for="size in getStock(item.stock.item.slug).stock" :key="size.id">
                <td>{{ size.size }}</td>
                <td>{{ size.stock }}</td>
              </tr>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <div style="margin-left:auto; display: flex; width: fit-content">
      <div class="button button--primary" @click="saveOrder">Save</div>
      <div class="button" @click="goBack">Cancel</div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      order: {},
      interval: null
    };
  },
  computed: {
    getStock(slug) {
      return this.$store.getters.getDashboardItem;
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
    saveOrder() {}
  },
  mounted() {
    this.$store.dispatch("fetchItemsDashboard");
    this.$store.dispatch("fetchOrder", this.$route.params.id);
    this.interval = setInterval(
      function() {
        this.order = this.$store.getters.getOrder;
        if (this.order !== {}) {
          this.interval = null;
        }
      }.bind(this),
      100
    );
  }
};
</script>

<style lang="scss" scoped>
.order-edit {
  tr {
    height: initial;
  }

  .align--top {
    vertical-align: top;
    padding-top: 15px !important;
    padding-bottom: 15px !important;
  }
}
</style>