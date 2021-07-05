let productName = document.getElementById('product_name');
let productNameFeedBack = document.getElementById('productNameFeedBack');
let newPrice = document.getElementById('newPrice');
let newPriceFeedBack = document.getElementById('newPriceFeedBack');
let oldPrice = document.getElementById('oldPrice');
let oldPriceFeedBack = document.getElementById('oldPriceFeedBack');
let description = document.getElementById('description');
let descriptionFeedBack = document.getElementById('descriptionFeedBack');

const handleAddProductFeeds = () => {
    if (productName.value.length > 0) {
        productNameFeedBack.textContent = '';
    } 
    if (newPrice.value.length > 0) {
        newPriceFeedBack.textContent = '';
    } 
    if (oldPrice.value.length > 0) {
        oldPriceFeedBack.textContent = '';
    } 
    if (description.value.length > 0) {
        descriptionFeedBack.textContent = '';
    } 
}
productName.addEventListener('keyup', handleAddProductFeeds);
newPrice.addEventListener('keyup', handleAddProductFeeds);
oldPrice.addEventListener('keyup', handleAddProductFeeds);
description.addEventListener('keyup', handleAddProductFeeds);