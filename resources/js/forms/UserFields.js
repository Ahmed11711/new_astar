export const fields = [
  { key: "username", label: "Username", required: 1, placeholder: "Enter Username", type: "text", isString: false },
  { key: "first_name", label: "First Name", required: 1, placeholder: "Enter First Name", type: "text", isString: false },
  { key: "last_name", label: "Last Name", required: 1, placeholder: "Enter Last Name", type: "text", isString: false },
  { key: "email", label: "Email", required: 1, placeholder: "Enter Email", type: "text", isString: false },
  { key: "password", label: "Password", required: 1, placeholder: "Enter Password", type: "password", isString: false },
  { key: "phone", label: "Phone", required: 1, placeholder: "Enter Phone", type: "text", isString: false },
  { key: "is_email_verified", label: "Is Email Verified", required: 1, placeholder: "Enter Is Email Verified", type: "boolean", isString: false },
  { key: "student_type", label: "Student Type", required: 1, placeholder: "Enter Student Type", type: "select", isString: false,
      options: [
    {
        "value": "individual",
        "label": "Individual"
    },
    {
        "value": "school",
        "label": "School"
    },
    {
        "value": "teacher",
        "label": "Teacher"
    }
] },
  { key: "role", label: "Role", required: 1, placeholder: "Enter Role", type: "select", isString: false,
      options: [
    {
        "value": "admin",
        "label": "Admin"
    },
    {
        "value": "school",
        "label": "School"
    },
    {
        "value": "teacher",
        "label": "Teacher"
    },
    {
        "value": "student",
        "label": "Student"
    },
    {
        "value": "data_entry",
        "label": "Data_entry"
    }
] },
  { key: "is_active", label: "Is Active", required: 1, placeholder: "Enter Is Active", type: "boolean", isString: false }
];