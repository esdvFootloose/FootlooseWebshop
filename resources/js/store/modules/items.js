import axios from 'axios';

const state = {
    items: [],
};


const mutations = {
    SET_ITEMS(state, items) {
        state.items = items;
    }
};

function parseData(data) {
    let parsedItems = [];
    for (let item in data) {
        item = data[item];
        let index = parsedItems.findIndex(object => object.name === item.name && object.gender === item.gender);
        if (index !== -1) {
            parsedItems[index].sizes.push({
                size: item.size,
                inStock: item.stock
            });
        } else {
            parsedItems.push({
                id: parsedItems.length,
                name: item.name,
                gender: item.gender,
                sizes: [
                    {
                        size: item.size,
                        inStock: item.stock > 0
                    }
                ],
                price: item.price,
                description: item.description,
                slug: (item.name + '-' + item.gender).toLowerCase()
            });
        }
    }
    return parsedItems;
}

const actions = {
    fetchItems({commit}) {
        axios.get('/api/stocks').then(result => {
            commit('SET_ITEMS', parseData(result.data.data));
        }).catch(error => {
            console.log(error);
        })
    },
};

const getters = {
    getItems: state => state.items,
    getItem(state) {
        return slug => state.items.find(item => {
            return item.slug === slug;
        })
    },
};


export default {
    state,
    mutations,
    actions,
    getters,
}