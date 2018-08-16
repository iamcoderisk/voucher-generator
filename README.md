## Voucher Code Generator
A voucher pool is a collection of (voucher) codes that can be used by customers (recipients)
to get discounts in a web shop.

### Website
<a href="https://voucher-generator.codefii.com">Explore</a>

### Functionalities
- For a given Special Offer and an expiration date generate for each Recipient a
Voucher Code. Once you create an offer with recipient, the creation date and the expiry date of the offer is automatically generated.
- Provide an endpoint, reachable via HTTP, which receives a Voucher Code and Email
and validates the Voucher Code. In Case it is valid, return the Percentage Discount
and set the date of usage(https://voucher-generator.codefii.com/?id=&item=&email=). with this if you're given a voucher or a coupon code you can use it to redeem an item from any location using postman or any other http request tool. Whether the purchase or redeem of an item is successful or not,  a response is been sent to you immediately.
- Extra: For a given Email, return all his valid Voucher Codes with the Name of the
Special Offer.

### Test
This small application is covered by a unit test which is located in the <b>tests<b> directory.
