window.yoopixelMenus = {
  posts: {
    title: "Manage Posts",
    items: [
      {
        title: "All Posts",
        icon: "dashicons-admin-post",
        url: "edit.php"
      },
      {
        title: "Add New",
        icon: "dashicons-plus",
        url: "post-new.php"
      },
      {
        title: "Categories",
        icon: "dashicons-category",
        url: "edit-tags.php?taxonomy=category"
      },
      {
        title: "Tags",
        icon: "dashicons-tag",
        url: "edit-tags.php?taxonomy=post_tag"
      }
    ]
  },

  media: {
    title: "Media Library",
    items: [
      {
        title: "Library",
        icon: "dashicons-format-image",
        url: "upload.php"
      },
      {
        title: "Add New",
        icon: "dashicons-plus",
        url: "media-new.php"
      }
    ]
  },

  plugins: {
    title: "Manage Plugins",
    items: [
      {
        title: "Installed Plugins",
        icon: "dashicons-admin-plugins",
        url: "plugins.php"
      },
      {
        title: "Add New",
        icon: "dashicons-plus",
        url: "plugin-install.php"
      },
      {
        title: "Plugin Editor",
        icon: "dashicons-editor-code",
        url: "plugin-editor.php"
      }
    ]
  },

  users: {
    title: "Manage Users",
    items: [
      {
        title: "All Users",
        icon: "dashicons-admin-users",
        url: "users.php"
      },
      {
        title: "Add New",
        icon: "dashicons-plus",
        url: "user-new.php"
      },
      {
        title: "Profile",
        icon: "dashicons-id",
        url: "profile.php"
      }
    ]
  },
  pages: {
  title: "Manage Pages",
  items: [
    {
      title: "All Pages",
      icon: "dashicons-admin-page",
      url: "edit.php?post_type=page"
    },
    {
      title: "Add New",
      icon: "dashicons-plus",
      url: "post-new.php?post_type=page"
    }
  ]
}
};
