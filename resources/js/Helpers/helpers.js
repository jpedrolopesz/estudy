export const colorPicker = [
  { id: "blue", label: "Blue" },
  { id: "cyan", label: "Cyan" },
  { id: "gray", label: "Gray" },
  { id: "green", label: "Green" },
  { id: "indigo", label: "Indigo" },
  { id: "orange", label: "Orange" },
  { id: "pink", label: "Pink" },
  { id: "purple", label: "Purple" },
  { id: "red", label: "Red" },
  { id: "rose", label: "Rose" },
  { id: "sky", label: "Sky" },
  { id: "teal", label: "Teal" },
  { id: "yellow", label: "Yellow" }
];

export const mailEncryption = [
  { id: "tls", label: "TLS" },
  { id: "ssl", label: "SSL" }
];
export const stripTags = (str) => str.replace(/(<([^>]+)>)/gi, "");

export const validateEmail = (email) => {
  const expr = /\S+@\S+\.\S+/;
  return expr.test(email);
};

export const unassigned = {
  // id: null,
  id: "unassigned",
  name: "Unassigned",
  avatar: "https://ui-avatars.com/api/?name=!&color=ffffff&background=f1f1f1"
};

export const unassignedFilter = {
  id: "unassigned",
  name: "Unassigned",
  avatar: "https://ui-avatars.com/api/?name=!&color=ffffff&background=f1f1f1"
};

export async function uploadedFileToBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}

export function imageFromBase64(file, filename, mimeType) {
  mimeType = mimeType || (file.match(/^data:([^;]+);/) || "")[1];
  return fetch(file)
    .then((res) => res.arrayBuffer())
    .then((buf) => new File([buf], filename, { type: mimeType }));
}

export async function urlToBase64(url) {
  const data = await fetch(url);
  const blob = await data.blob();
  return new Promise((resolve) => {
    const reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = () => {
      const base64data = reader.result;
      resolve(base64data);
    };
  });
}

export function getTypeFromBase64(file) {
  return (file.match(/^data:([^;]+);/) || "")[1];
}

/**
 * Format a number as a currency string
 */
export const currency = (value, currency = "USD") =>
  new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: currency,
    maximumFractionDigits: 2
  }).format(value);


export const attachmentTypes = `
    application/*,
    image/*,
    text/*,
    video/*,
    audio/*,
`;