import { useShop } from './shop'


export const initFakeShop = () => {

    const shop = useShop();
    shop.initShop()
    const data = shop.shopData;
    data.value.catalogs.main = catalog1;
    shop.updateLocal();

}


const catalog1 = [
    {
        id: 1,
        user_id: 0,
        title: 'Платье ZARA',
        description: 'Описание этого отличного предмета одежды',
        place: 'Москва',
        img: '',
        stars: 3,
        categories: [0,3,5],
        collections: [0,4],
        price: 1500
    },
    {
        id: 2,
        user_id: 0,
        title: 'Рубашка',
        description: 'Рубашка б/у но красивая',
        place: 'Москва',
        img: '',
        stars: 5,
        categories: [0,3,5],
        collections: [0,4],
        price: 1200
    }
]

