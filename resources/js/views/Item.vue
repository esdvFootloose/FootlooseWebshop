<template>
  <div class="content content--item">
    <card
      :is-detailed="true"
      :image="item.image"
      :large-image="true"
      :title="
                item.name +
                    ' ' +
                    (item.gender === 'Unisex' ? '' : item.gender.toLowerCase())
            "
    >
      <template v-slot:description>
        <div class="item__description">
          <div v-if="item.description" v-html="item.description"></div>
          <div v-bind:class="{ item__options: item.description }">
            <label for="itemSize">Size</label>
            <select v-model="selectedSize" id="itemSize">
              <option disabled value>Select a size</option>
              <option v-for="size in item.stock">
                {{
                size.size
                }}
              </option>
            </select>
          </div>
          <div>
            <label for="itemAmount">Amount</label>
            <input type="number" id="itemAmount" v-model="selectedAmount" style="width: 4em" />
          </div>
        </div>
        <div class="item__buttons width--full">
          <div
            class="button button--primary button--fixed-width"
            :class="{ 'button--disabled': !canAddItem }"
            @click="addToCart"
          >Add to cart</div>
          <div
            class="button button--fixed-width"
            @click="addToRequests"
            v-if="!itemInStock"
          >Request item</div>
          <div class="item__buttons__oof-text" v-if="!itemInStock">
            This article for this amount is out of stock, request
            the item and we’ll keep you up-to-date on new stock with
            your size.
          </div>
          <div class="align--center" v-if="textMessage">{{ textMessage }}</div>
        </div>
      </template>
    </card>
  </div>
</template>

<script>
import Card from "../components/Card";

export default {
  components: {
    Card
  },
  computed: {
    item: function() {
      return this.$store.getters.getItem(this.$route.params.slug);
    },
    cart: function() {
      return this.$store.getters.getCart;
    },
    canAddItem: function() {
      // Initial case: assure no item can be added or requested
      if (this.selectedSize === "") {
        return false;
      } else {
        return (
          this.item.stock.filter(size => size.size === this.selectedSize)[0]
            .stock >= this.selectedAmount && this.selectedAmount > 0
        );
      }
    },
    itemInStock: function() {
      // Initial case: assure no item can be added or requested
      if (this.selectedSize === "") {
        return true;
      } else {
        return (
          this.item.stock.filter(size => size.size === this.selectedSize)[0]
            .stock >= this.selectedAmount
        );
      }
    }
  },
  data: function() {
    return {
      selectedSize: "",
      selectedAmount: 1,
      textMessage: ""
    };
  },
  methods: {
    addToCart: function() {
      if (!this.canAddItem) {
        return;
      }
      let size = this.item.stock.filter(
        size => size.size === this.selectedSize
      )[0];
      let currentCartItem = this.cart.filter(
        item => item.item_id === this.item.id && item.size_id === size.id
      );
      let cartItem = {
        item_id: this.item.id,
        stock_id: size.id,
        amount: Number(this.selectedAmount)
      };
      if (currentCartItem.length === 0) {
        this.$store.dispatch("addItemToCart", cartItem);
      } else {
        this.$store.dispatch("addItemToCart", cartItem);
      }
      this.textMessage = "Item added to cart";
      let that = this;
      setTimeout(function() {
        that.textMessage = "";
      }, 5000);
    },
    addToRequests: function() {
      let size = this.item.stock.filter(
        size => size.size === this.selectedSize
      )[0];
      let requestedItem = {
        user_id: this.$store.getters.getUser.id,
        item_id: this.item.id,
        size_id: size.id,
        amount: this.selectedAmount,
      };
      this.$store.dispatch("requestItem", requestedItem);
      this.textMessage = "Item has been requested";
      let that = this;
      setTimeout(function() {
        that.textMessage = "";
      }, 5000);
    },
    updateStockInfo: function() {
      this.canAddItem();
      this.itemInStock();
    }
  },
  mounted() {
    this.$store.dispatch("fetchItems");
    if (this.$route.params.size) {
      this.selectedSize = this.$route.params.size;
      this.selectedAmount = this.$store.getters.itemInCart({
        slug: this.$route.params.slug,
        size: this.$route.params.size
      }).amount;
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

.content {
  &--item {
    @media all and (min-width: $breakpoint--web-large) {
      padding-left: 320px;
      padding-right: 320px;
    }
  }
}

.item {
  &__buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: auto;

    &__oof-text {
      margin: 12px 10px;

      @media all and (min-width: $breakpoint--web) {
        width: calc(100% - 360px);
        min-width: 300px;
      }
    }

    @media all and (min-width: $breakpoint--tablet) {
      max-width: 300px;
    }

    @media all and (min-width: $breakpoint--web) {
      /*position: absolute;*/
      bottom: 35px;
      width: auto;
      max-width: initial;
      flex-wrap: wrap;
      margin-left: -10px;
      justify-content: flex-start;
    }
  }

  &__options {
    margin-top: 20px;
  }
}
</style>
