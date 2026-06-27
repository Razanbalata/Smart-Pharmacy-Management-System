# Business Rules

## Products

- SKU must be unique.
- Selling price cannot be lower than purchase price.
- Product stock cannot become negative.

---

## Purchases

- Every purchase increases stock.
- Purchase must belong to one supplier.

---

## Sales

- A sale cannot exceed available stock.
- Every sale decreases stock.

---

## Inventory

- Low stock = stock_quantity <= minimum_stock.
- Expired products cannot be sold.

---

## Notifications

- Notify when stock becomes low.
- Notify when products are close to expiration.