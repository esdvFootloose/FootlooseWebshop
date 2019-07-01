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
    console.log(data);
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
                description: item.description
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
};


export default {
    state,
    mutations,
    actions,
    getters,
}