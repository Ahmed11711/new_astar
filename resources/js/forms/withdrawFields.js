export const fields = [
  { key: "user_id", label: "User Id", required: 1, placeholder: "Enter User Id", type: "number", isString: false },
  { key: "name", label: "Name", required: 1, placeholder: "Enter Name", type: "text", isString: false },
  { key: "phone", label: "Phone", required: 1, placeholder: "Enter Phone", type: "text", isString: false },
  { key: "email", label: "Email", required: 1, placeholder: "Enter Email", type: "text", isString: false },
  { key: "country", label: "Country", required: 1, placeholder: "Enter Country", type: "text", isString: false },
  { key: "bank_name", label: "Bank Name", required: 1, placeholder: "Enter Bank Name", type: "text", isString: false },
  { key: "iban", label: "Iban", required: 1, placeholder: "Enter Iban", type: "text", isString: false },
  { key: "software", label: "Software", required: 1, placeholder: "Enter Software", type: "text", isString: false },
  { key: "status", label: "Status", required: 1, placeholder: "Enter Status", type: "select", isString: false,
      options: [
    {
        "value": "pending",
        "label": "Pending"
    },
    {
        "value": "confirmed",
        "label": "Confirmed"
    },
    {
        "value": "reject",
        "label": "Reject"
    }
] },
  { key: "amount", label: "Amount", required: 1, placeholder: "Enter Amount", type: "number", isString: false },
  { key: "method", label: "Method", required: 1, placeholder: "Enter Method", type: "select", isString: false,
      options: [
    {
        "value": "bank",
        "label": "Bank"
    },
    {
        "value": "bank_dollar",
        "label": "Bank_dollar"
    },
    {
        "value": "wallet",
        "label": "Wallet"
    }
] },
  { key: "note", label: "Note", required: 1, placeholder: "Enter Note", type: "textarea", isString: false },
  { key: "type_withdraw", label: "Type Withdraw", required: 1, placeholder: "Enter Type Withdraw", type: "select", isString: false,
      options: [
    {
        "value": "affiliate",
        "label": "Affiliate"
    },
    {
        "value": "profit_ads",
        "label": "Profit_ads"
    }
] },
  { key: "address", label: "Address", required: 1, placeholder: "Enter Address", type: "text", isString: false }
];